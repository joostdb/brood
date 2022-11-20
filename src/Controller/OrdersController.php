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
        $this->Authentication->addUnauthenticatedActions(['clientadd']);

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
        foreach ($orderitems AS $item){

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


    public function clientadd()
    {
       // $this->viewBuilder()->setLayout('clientorder');

        $tour = $this->fetchTable('Tour')->find('all')->select(['id'])->where(['md5(id)' => $this->request->getQuery('t')])->toArray();
        $tour = $this->fetchTable('Tour')->get($tour['0']['id']);
        $this->set('tour', $tour);
        $user = $this->fetchTable('Users')->find('all')->select(['id'])->where(['md5(id)' => $this->request->getQuery('c')])->toArray();
        $user = $this->fetchTable('Users')->get($user['0']['id']);
        $this->set('user', $user);


        //Is er reeds een bestelling?


        $order = $this->Orders->find()->where(['tour_id' => $tour->id, 'user_id' => $user->id])->first();

        if($order){
            $orderitems = json_decode($order->itemorders);
            foreach ($orderitems AS $item){

                $orders[$item->item] = $this->fetchTable('Items')->get($item->item);
                $orders[$item->item]->orderedquantity = $item->quantity;
            }

            $this->set(compact('order', 'orders'));

        }


        $tourusers = json_decode($tour->clients);

        if (in_array($user->id, $tourusers)) { //deze klant behoort tot deze ronde

            $delivery = $this->fetchTable('Delivery')->get($tour->delivery_id);
            $delivery['itemlist'] = json_decode($delivery->items);
            $this->set('delivery', $delivery);



            if ($this->request->is('post')) {

                    $newdata = $this->request->getData();
                    $newitem = $this->request->getData();

                    foreach ($newdata['item'] AS $item){
                        $itemorder = $this->fetchTable('Itemorders')->newEmptyEntity();

                        $itemorder['quantity'] = $newitem['quantity'][$item];
                        $itemorder['item'] = $item;

                        $item = $this->fetchTable('Items')->get($item);
                        $price = $item->price * $newitem['quantity'][$item->id];
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


                                        $mailer = new Mailer('default');

                                      $mailer->setEmailFormat('html')
                                            ->setFrom(['brood@eke.be' => 'Brood'])
                                            ->setTo($user->email)

                                            ->setSubject('')
                                            ->viewBuilder()
                                            ->setTemplate('default')
                                            ->setLayout('default');
                                        $mailer->deliver('eee');

                    return $this->redirect(['controller' => 'orders','action' => 'clientadd', '?' =>['t' => $this->request->getQuery('t'), 'c' => $this->request->getQuery('c')]]);
                }






                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
          //  $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
           // $this->set(compact('order', 'users'));
        }
        else{
            $this->Flash->error(__('You are no part of this tour.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }


    }


}
