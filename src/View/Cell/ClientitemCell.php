<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Clientitem cell
 */
class ClientitemCell extends Cell
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
    public function display($id, $tour)
    {
        $item = $this->fetchTable('Items')->get($id, [
            'contain' => ['Stock'],
        ]);

        $item->tour = $this->fetchTable('Tour')->get($tour);


        foreach ($item->stock AS $stock)
        {
            $item->stocktotaal = $item->stocktotaal + $stock->quantity;
        }

        $this->set(compact('item'));
    }
}
