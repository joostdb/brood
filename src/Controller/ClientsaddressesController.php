<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clientsaddresses Controller
 *
 * @property \App\Model\Table\ClientsaddressesTable $Clientsaddresses
 * @method \App\Model\Entity\Clientsaddress[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsaddressesController extends AppController
{
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
        $clientsaddresses = $this->paginate($this->Clientsaddresses);

        $this->set(compact('clientsaddresses'));
    }

    /**
     * View method
     *
     * @param string|null $id Clientsaddress id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientsaddress = $this->Clientsaddresses->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('clientsaddress'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientsaddress = $this->Clientsaddresses->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientsaddress = $this->Clientsaddresses->patchEntity($clientsaddress, $this->request->getData());
            if ($this->Clientsaddresses->save($clientsaddress)) {
                $this->Flash->success(__('The clientsaddress has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clientsaddress could not be saved. Please, try again.'));
        }
        $users = $this->Clientsaddresses->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('clientsaddress', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clientsaddress id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientsaddress = $this->Clientsaddresses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientsaddress = $this->Clientsaddresses->patchEntity($clientsaddress, $this->request->getData());
            if ($this->Clientsaddresses->save($clientsaddress)) {
                $this->Flash->success(__('The clientsaddress has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clientsaddress could not be saved. Please, try again.'));
        }
        $users = $this->Clientsaddresses->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('clientsaddress', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clientsaddress id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientsaddress = $this->Clientsaddresses->get($id);
        if ($this->Clientsaddresses->delete($clientsaddress)) {
            $this->Flash->success(__('The clientsaddress has been deleted.'));
        } else {
            $this->Flash->error(__('The clientsaddress could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
