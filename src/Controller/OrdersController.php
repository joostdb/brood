<?php
declare(strict_types=1);

namespace App\Controller;


use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['clientadd', 'clientdelete']);

    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Users']
        ]);
        $orderitems = json_decode($order->itemorders);
        foreach ($orderitems as $item) {

            $orders[$item->item] = $this->fetchTable('Items')->get($item->item);
            $orders[$item->item]->orderedquantity = $item->quantity;
        }


        $this->set(compact('order', 'orders'));


    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Tour'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'users'));

        $tour = $this->Orders->Tour->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'tour'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);

        if ($this->Orders->delete($order)) {

            $itemorders = $this->fetchTable('Itemorders')->find('all')->where(['user_id' => $order->user_id, 'tour_id' => $order->tour_id])->toArray();
            $this->fetchTable('Itemorders')->deleteMany($itemorders);

            $stock = $this->fetchTable('Stock')->find('all')->where(['user_id' => $order->user_id, 'tour_id' => $order->tour_id])->toArray();
            $this->fetchTable('Stock')->deleteMany($stock);

            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        $this->redirect($this->referer());
    }

    public function clientdelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $order = $this->Orders->find()->where(['md5(id)' => $id])->first();
        if ($this->Orders->delete($order)) {

            $itemorders = $this->fetchTable('Itemorders')->find('all')->where(['user_id' => $order->user_id, 'tour_id' => $order->tour_id])->toArray();
            $this->fetchTable('Itemorders')->deleteMany($itemorders);

            $stock = $this->fetchTable('Stock')->find('all')->where(['user_id' => $order->user_id, 'tour_id' => $order->tour_id])->toArray();
            $this->fetchTable('Stock')->deleteMany($stock);

            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        $this->redirect($this->referer());
    }


    public function clientadd()
    {
        // $this->viewBuilder()->setLayout('clientorder');

        $tour = $this->fetchTable('Tour')->find('all')->select(['id'])->where(['md5(id)' => $this->request->getQuery('t')])->toArray();
        $tour = $this->fetchTable('Tour')->get($tour['0']['id']);
        $this->set('tour', $tour);
        $user = $this->fetchTable('Users')->find('all')->select(['Users.id'])->where(['md5(Users.id)' => $this->request->getQuery('c')])->toArray();
        $user = $this->fetchTable('Users')->get($user['0']['id'], [
            'contain' => ['Clientsaddresses'],
        ]);
        $this->set('user', $user);
        $this->set('profile', 1);
        //Controle op profiel
        if(!$user->clientsaddress->street || !$user->clientsaddress->number || !$user->clientsaddress->city){
            $this->set('profile', 0);
        }

        //Is er reeds een bestelling?


        $order = $this->Orders->find()->where(['tour_id' => $tour->id, 'user_id' => $user->id])->first();

        if ($order) {
            $orderitems = json_decode($order->itemorders);
            foreach ($orderitems as $item) {

                $pendingorders[$item->item] = $this->fetchTable('Items')->get($item->item);
                $pendingorders[$item->item]->orderedquantity = $item->quantity;
            }

            $this->set(compact('order', 'pendingorders'));

        }


        $tourusers = json_decode($tour->clients);

        if (in_array($user->id, $tourusers)) { //deze klant behoort tot deze ronde

            $delivery = $this->fetchTable('Delivery')->get($tour->delivery_id);
            $delivery['itemlist'] = json_decode($delivery->items);
            $this->set('delivery', $delivery);


            if ($this->request->is('post')) {

                $newdata = $this->request->getData();
                $newitem = $this->request->getData();

                if(array_sum($newitem['quantity']) == 0){
                    return $this->redirect(['controller' => 'orders', 'action' => 'clientadd', '?' => ['t' => $this->request->getQuery('t'), 'c' => $this->request->getQuery('c')]]);
                }

                foreach ($newdata['item'] as $item) {
                    $itemorder = $this->fetchTable('Itemorders')->newEmptyEntity();

                    $itemorder['quantity'] = $newitem['quantity'][$item];
                    $itemorder['item'] = $item;

                    $item = $this->fetchTable('Items')->get($item);
                    $price = $item->price * $itemorder['quantity'];
                    $itemorder['price'] = $price;
                    $totalprice[] = $price;
                    $totalpieces[] = $itemorder['quantity'];
                    $itemorder['user_id'] = $user->id;
                    $itemorder['date'] = FrozenTime::now();
                    $itemorder['review'] = '1';
                    $itemorder['pay'] = '0';
                    $itemorder['notes'] = '1';
                    $itemorder['order_session'] = $newdata['order_session'];
                    $itemorder['tour_id'] = $newdata['tour_id'];

                    if($itemorder['quantity'] >= 1){
                        $mailorders[$item->id]['name'] = $item->name;
                        $mailorders[$item->id]['quantity'] = $itemorder['quantity'];
                        $mailorders[$item->id]['price'] = $price;
                    }


                    $totalitemorders[] = $itemorder;
                    //  $itemorder = $this->fetchTable('Itemorders')->patchEntity($itemorder, $newitem);

                    if ($this->fetchTable('Itemorders')->save($itemorder)) {
                        //stock aanvullen
                        $stockitem = $this->fetchTable('Stock')->newEmptyEntity();
                        $stockitem['item_id'] = $itemorder['item'];
                        $stockitem['user_id'] = $user->id;
                        $stockitem['tour_id'] = $newdata['tour_id'];
                        $stockitem['quantity'] = $itemorder['quantity'];
                        $stockitem['date'] = FrozenTime::now();
                        $this->fetchTable('Stock')->save($stockitem);

                        //$this->Flash->success(__('The item {0} has been saved.', $item->name));
                    }
                }

                $order = $this->Orders->newEmptyEntity();

                $newdata['user_id'] = $user->id;
                $newdata['date'] = FrozenTime::now();
                $newdata['quantity'] = array_sum($totalpieces);
                $newdata['price'] = array_sum($totalprice);
                $newdata['pay'] = 0;
                $newdata['review'] = 0;
                $newdata['itemorders'] = json_encode($totalitemorders);

                $order = $this->Orders->patchEntity($order, $newdata);

                if ($this->Orders->save($order)) {
                    $this->Flash->success(__('The order has been saved.'));

                    $body = "Beste " . $user->first_name ;
                    $body .= "<br><br>Bedankt voor je bestelling, hieronder zie je een overzicht.<br><br>";
                    foreach($mailorders AS $mailorder){
                        $body .= @$mailorder['quantity'] . " x " . @$mailorder['name'] . ": €" . @$mailorder['price'];
                        $body .= "<br>";
                    }

                    $body .= "<HR>";
                    $body .= "Totaalbedrag: €" . $newdata['price'];



                    $mailer = new Mailer('default');


                    $mailer->setEmailFormat('html')
                        ->setFrom(['brood@eke.be' => 'Brood'])
                        ->setTo($user->email)
                        ->setBcc('joostdb+brood@gmail.com')
                        ->setSubject(__('Your order'))
                        ->viewBuilder()
                        ->setTemplate('default')
                        ->setLayout('default');
                    $mailer->deliver($body);


                    return $this->redirect(['controller' => 'orders', 'action' => 'clientadd', '?' => ['t' => $this->request->getQuery('t'), 'c' => $this->request->getQuery('c')]]);
                }


                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
            //  $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
            // $this->set(compact('order', 'users'));
        } else {
            $this->Flash->error(__('You are no part of this tour.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }



        $lastorders = $this->fetchTable('Orders')->find()->contain(['Users'])->where(['user_id' => $user->id])->limit(5)->order(['Orders.id' => 'desc'])->toArray();;

        foreach($lastorders AS $lastorder) {
            $orderitems = json_decode($lastorder['itemorders']);
            foreach ($orderitems as $item) {

                $orders[$item->item] = $this->fetchTable('Items')->get($item->item);
                $orders[$item->item]->orderedquantity = $item->quantity;
                $orders[$item->item]->orderedprice = $item->price;
            }

            $this->set(compact('orders'));

        }


        $this->set(compact('lastorders'));


    }

    public function calendar()
    {
        // Retrieve the current date and time
        $currentDateTime = new \DateTime();

        // Set the timezone to use for the calendar
        $timezone = new \DateTimeZone('America/New_York');
        $currentDateTime->setTimezone($timezone);

        // Set the start and end times for the calendar
        $startTime = clone $currentDateTime;
        $startTime->setTime(9, 0);

        $endTime = clone $currentDateTime;
        $endTime->setTime(18, 59);

        // Create an array of time slots every 15 minutes
        $timeSlots = [];
        $currentTime = clone $startTime;
        while ($currentTime <= $endTime) {
            $timeSlots[] = $currentTime->format('H:i');
            $currentTime->modify('+15 minutes');
        }

        // Set the variables to be passed to the view
        $this->set(compact('currentDateTime', 'timeSlots'));
    }
    public function gettimeslots()
    {
        // set the date to yesterday
        $yesterday = FrozenTime::now()->subDay();

        $startTime = $yesterday->setTime(9, 0); // set the start time for the calendar to 9:00 am
        $endTime = $yesterday->setTime(17, 0); // set the end time for the calendar to 5:00 pm

        $interval = new \DateInterval('PT15M'); // create a DateInterval object with a interval of 15 minutes

        $period = new \DatePeriod($startTime, $interval, $endTime); // create a DatePeriod object starting at the start time, with the interval specified above, and ending at the end time

        $calendar = []; // create an array to hold the calendar data

        foreach ($period as $time) { // loop through each time in the period
            $calendar[] = [
                'time' => $time->i18nFormat('H:mm'), // format the time as a string
                'event' => null // set the default event for each time as null
            ];
        }
        $output = $yesterday;
        $this->set(compact('calendar')); // pass the calendar array to the view
        $this->set(compact('output')); // pass the calendar array to the view

        // render the same view as the index action
        $this->render('calendar');
    }

}
