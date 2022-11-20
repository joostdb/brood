<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Delivery Controller
 *
 * @property \App\Model\Table\DeliveryTable $Delivery
 * @method \App\Model\Entity\Delivery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliveryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $delivery = $this->paginate($this->Delivery);

        $this->set(compact('delivery'));
    }

    /**
     * View method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delivery = $this->Delivery->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('delivery'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $delivery = $this->Delivery->newEmptyEntity();

        $items = $this->fetchTable('Items')->find('list')->order(['id' => 'desc'])->toArray();
        $this->set('items', $items);


        if ($this->request->is('post')) {

            $newdata = $this->request->getData();
            $newdata['items'] = json_encode($newdata['items']);
            $newdata['user_id'] = $this->user_id;

            $delivery = $this->Delivery->patchEntity($delivery, $newdata);
            if ($this->Delivery->save($delivery)) {
                $this->Flash->success(__('The delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('delivery'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $delivery = $this->Delivery->get($id, [
            'contain' => [],
        ]);
        $delivery->items = json_decode($delivery->items);
        $items = $this->fetchTable('Items')->find('list')->order(['id' => 'desc'])->toArray();
        $this->set('itemsext', $items);

       // $delivery->items = json_decode($delivery->items, );
        if ($this->request->is(['patch', 'post', 'put'])) {

            $newdata = $this->request->getData();
            $newdata['items'] = json_encode($newdata['items']);

            $delivery = $this->Delivery->patchEntity($delivery, $newdata);
            if ($this->Delivery->save($delivery)) {
                $this->Flash->success(__('The delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('delivery'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $delivery = $this->Delivery->get($id);
        if ($this->Delivery->delete($delivery)) {
            $this->Flash->success(__('The delivery has been deleted.'));
        } else {
            $this->Flash->error(__('The delivery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
