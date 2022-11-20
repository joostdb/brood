<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Stock Controller
 *
 * @property \App\Model\Table\StockTable $Stock
 * @method \App\Model\Entity\Stock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items', 'Users'],
        ];
        $stock = $this->paginate($this->Stock);

        $this->set(compact('stock'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stock = $this->Stock->get($id, [
            'contain' => ['Items', 'Users'],
        ]);

        $this->set(compact('stock'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stock = $this->Stock->newEmptyEntity();
        if ($this->request->is('post')) {
            $stock = $this->Stock->patchEntity($stock, $this->request->getData());
            if ($this->Stock->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $items = $this->Stock->Items->find('list', ['limit' => 200])->all();
        $users = $this->Stock->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('stock', 'items', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stock = $this->Stock->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stock = $this->Stock->patchEntity($stock, $this->request->getData());
            if ($this->Stock->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $items = $this->Stock->Items->find('list', ['limit' => 200])->all();
        $users = $this->Stock->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('stock', 'items', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stock = $this->Stock->get($id);
        if ($this->Stock->delete($stock)) {
            $this->Flash->success(__('The stock has been deleted.'));
        } else {
            $this->Flash->error(__('The stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
