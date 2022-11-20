<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tour Controller
 *
 * @property \App\Model\Table\TourTable $Tour
 * @method \App\Model\Entity\Tour[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TourController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tour = $this->paginate($this->Tour);

        $this->set(compact('tour'));
    }

    /**
     * View method
     *
     * @param string|null $id Tour id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tour = $this->Tour->get($id, [
            'contain' => ['Itemorders'],
        ]);
        $this->tourid = $id;

        $this->set(compact('tour'));
        $tourclients = json_decode($tour->clients, false);

        $clients = $this->fetchTable('Users')->find()
        ->contain('itemorders',function($q){ return $q->where(['tour_id' => $this->tourid]);})
        ->where(['Users.id IN' => $tourclients])->toArray();
        $this->set('clients', $clients);


            $items = $this->fetchTable('Itemorders')->find()->where(['tour_id'=>$id])->toArray();
          //  dd($items);
       $totalen = false;
            foreach ($items AS $item){
                $i = $this->fetchTable('Items')->get($item['item']);
                $totalen[$i->id]['quantity'] = @$totalen[$i->id]['quantity'] + $item['quantity'];
                $totalen[$i->id]['name'] = $i->name;
                $totalen[$i->id]['item'] = $i->id;

                $orderitem[$item['id']]['id'] = $item['item'];
                $orderitem[$item['id']]['name'] = $i->name;
                $orderitem[$item['id']]['quantity'] = $item['quantity'];
            }

        $this->set('order', $orderitem);
        $this->set('totalen', $totalen);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tour = $this->Tour->newEmptyEntity();

        $delivery = $this->fetchTable('Delivery')->find('list')->order(['id' => 'desc'])->toArray();
        $this->set('delivery', $delivery);

        $clients = $this->fetchTable('Users')->find('list')->order(['id' => 'asc'])->toArray();
        $this->set('clients', $clients);

        if ($this->request->is('post')) {

            $newdata = $this->request->getData();
            $newdata['clients'] = json_encode($newdata['clients']);
            $newdata['user_id'] = $this->user_id;
            $tour = $this->Tour->patchEntity($tour, $newdata);
            if ($this->Tour->save($tour)) {
                $this->Flash->success(__('The tour has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tour could not be saved. Please, try again.'));
        }
        $this->set(compact('tour'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tour id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tour = $this->Tour->get($id, [
            'contain' => [],
        ]);
        $tour->clients = json_decode($tour->clients);

        $delivery = $this->fetchTable('Delivery')->find('list')->order(['id' => 'desc'])->toArray();
        $this->set('deliveryext', $delivery);


        $clients = $this->fetchTable('Users')->find('list')->order(['id' => 'asc'])->toArray();
        $this->set('clientsext', $clients);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $newdata = $this->request->getData();
            $newdata['clients'] = json_encode($newdata['clients']);

            $tour = $this->Tour->patchEntity($tour, $newdata);
            if ($this->Tour->save($tour)) {
                $this->Flash->success(__('The tour has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tour could not be saved. Please, try again.'));
        }
        $this->set(compact('tour'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tour id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tour = $this->Tour->get($id);
        if ($this->Tour->delete($tour)) {
            $this->Flash->success(__('The tour has been deleted.'));
        } else {
            $this->Flash->error(__('The tour could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function invitations($id = null)
    {


        $tour = $this->Tour->get($id, [
            'contain' => ['Itemorders'],
        ]);
        $this->tourid = $id;

        $this->set(compact('tour'));
        $tourclients = json_decode($tour->clients, false);

        $clients = $this->fetchTable('Users')->find()->contain('Clientsaddresses')
            ->where(['Users.id IN' => $tourclients])->toArray();

        $this->set('clients', $clients);
    }

    public function dashboard()
    {
        $tour = $this->Tour->find('all', ['order' => ['id' => 'DESC']])->contain('Itemorders')->first();
        if($tour){
            $delivery = $this->fetchTable('Delivery')->get($tour->delivery_id);
            $this->set(compact('delivery'));

            $this->tourid = $tour->id;

            $this->set(compact('tour'));
            $tourclients = json_decode($tour->clients, false);

            $clients = $this->fetchTable('Users')->find()
                ->contain('itemorders',function($q){ return $q->where(['tour_id' => $this->tourid]);})
                ->where(['Users.id IN' => $tourclients])->toArray();
            $this->set('clients', $clients);


            $items = $this->fetchTable('Itemorders')->find()->where(['tour_id'=>$tour->id])->toArray();
            //  dd($items);
            $totalen = false;
            foreach ($items AS $item){
                $i = $this->fetchTable('Items')->get($item['item']);
                $totalen[$i->id]['quantity'] = @$totalen[$i->id]['quantity'] + $item['quantity'];
                $totalen[$i->id]['name'] = $i->name;
                $totalen[$i->id]['item'] = $i->id;

                $orderitem[$item['id']]['id'] = $item['item'];
                $orderitem[$item['id']]['name'] = $i->name;
                $orderitem[$item['id']]['quantity'] = $item['quantity'];
            }

            $this->set('order', $orderitem);
            $this->set('totalen', $totalen);
        }

    }
}
