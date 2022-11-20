<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Itemorders Controller
 *
 * @property \App\Model\Table\ItemordersTable $Itemorders
 * @method \App\Model\Entity\Itemorder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemordersController extends AppController
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
        $itemorders = $this->paginate($this->Itemorders);

        $this->set(compact('itemorders'));
    }

    /**
     * View method
     *
     * @param string|null $id Itemorder id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemorder = $this->Itemorders->get($id, [
            'contain' => ['Users'],
            'contain' => ['Items'],
        ]);

        $this->set(compact('itemorder'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemorder = $this->Itemorders->newEmptyEntity();
        if ($this->request->is('post')) {
            $itemorder = $this->Itemorders->patchEntity($itemorder, $this->request->getData());
            if ($this->Itemorders->save($itemorder)) {
                $this->Flash->success(__('The itemorder has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itemorder could not be saved. Please, try again.'));
        }
        $users = $this->Itemorders->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('itemorder', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Itemorder id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemorder = $this->Itemorders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemorder = $this->Itemorders->patchEntity($itemorder, $this->request->getData());
            if ($this->Itemorders->save($itemorder)) {
                $this->Flash->success(__('The itemorder has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itemorder could not be saved. Please, try again.'));
        }
        $users = $this->Itemorders->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('itemorder', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Itemorder id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemorder = $this->Itemorders->get($id);
        if ($this->Itemorders->delete($itemorder)) {
            $this->Flash->success(__('The itemorder has been deleted.'));
        } else {
            $this->Flash->error(__('The itemorder could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
