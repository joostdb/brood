<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Clienthistory cell
 */
class ClienthistoryCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array<string, mixed>
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($id)
    {
        $lastorders = $this->fetchTable('Orders')->find()->contain(['Users'])->where(['user_id' => $id])->limit(5)->order(['Orders.id' => 'desc'])->toArray();
//dd($lastorders);



        $this->set(compact('lastorders'));


    }
}
