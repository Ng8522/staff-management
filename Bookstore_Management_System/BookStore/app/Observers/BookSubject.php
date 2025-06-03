<?php
/**
 * File Name: BookSubject.php
 * Description:  Subject in Observer pattern
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */

namespace App\Observers;
use App\Observers\ObserverInterface;
use App\Observers\SubjectInterface;

class BookSubject implements SubjectInterface
{
    private $observers = [];

    public function attach(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer)
    {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
        // This line will not work directly. You need a way to trigger the JS.
        // A workaround: Use session flash to notify via the next request.
        session(['book_updated' => true]);
    }
}
