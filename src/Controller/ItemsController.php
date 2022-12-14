<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Mailer\Mailer;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\FrozenTime;
use Cake\I18n\I18n;
/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        $this->Authentication->addUnauthenticatedActions(['view']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $items = $this->paginate($this->Items);
        $result = $this->Authentication->getResult();
        $this->set(compact('items'));
        $this->set('ee', $result);
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('item'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $item = $this->Items->newEmptyEntity();
        if ($this->request->is('post')) {
            $newdata = $this->request->getData();

            $newdata['user_id'] = $this->user_id;
            $item = $this->Items->patchEntity($item, $newdata);

            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $this->set(compact('item'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newdata = $this->request->getData();
            if(@$newdata['del_photo']){

                $files = glob('/var/www/clients/client0/web10/web/brood/webroot/files/items/photo/' . $newdata['photo_dir'].'/*');
                if (is_array($files) || is_object($files)) {
                foreach($files as $file) {
                    if(is_file($file))
                        unlink($file);
                }
                    rmdir('/var/www/clients/client0/web10/web/brood/webroot/files/items/photo/' . $newdata['photo_dir']);
                }

                $newdata['photo'] = '';
                $newdata['photo_dir'] = '';

            }
            $item = $this->Items->patchEntity($item, $newdata);
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $this->set(compact('item'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
