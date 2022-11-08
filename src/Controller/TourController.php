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
            'contain' => [],
        ]);

        $this->set(compact('tour'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tour = $this->Tour->newEmptyEntity();
        if ($this->request->is('post')) {
            $tour = $this->Tour->patchEntity($tour, $this->request->getData());
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tour = $this->Tour->patchEntity($tour, $this->request->getData());
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
}
