<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait SweetAlertNotifications
{
    /**
     * Sends a SweetAlert2 flash message to the session.
     *
     * @param string $icon Icon type (e.g., 'success', 'error', 'warning', 'info', 'question').
     * @param string $title Message title.
     * @param string $text Message text.
     * @param int|null $timer Duration in milliseconds for the alert to auto-close. Null to keep it open.
     * @param bool $showConfirmButton Whether to show the confirm button.
     * @return void
     */
    protected function sendSweetAlert(
        string $icon,
        string $title,
        string $text,
        ?int $timer = 5000, // Defaults to closing in 5 seconds
        bool $showConfirmButton = false // Defaults to not showing a confirm button
    ): void {
        Session::flash('swal', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timer' => $timer,
            'showConfirmButton' => $showConfirmButton,
        ]);
    }

    /**
     * Sends a success notification for a creation event.
     *
     * @param string $itemName The name of the item that was created (e.g., 'User', 'Role').
     * @param int|null $timer Timer duration, if different from the default.
     * @return void
     */
    protected function createdNotification(string $itemName, ?int $timer = 5000): void
    {
        $this->sendSweetAlert(
            'success',
            __(':name created!', ['name' => __($itemName)]),
            __(':name has been created', ['name' => __($itemName)]),
            $timer,
            true
        );
    }

    /**
     * Sends a success notification for an update event.
     *
     * @param string $itemName The name of the item that was updated (e.g., 'User', 'Role').
     * @param int|null $timer Timer duration, if different from the default.
     * @return void
     */
    protected function updatedNotification(string $itemName, ?int $timer = 5000): void
    {
        $this->sendSweetAlert(
            'success',
            __(':name updated!', ['name' => __($itemName)]),
            __(':name has been updated', ['name' => __($itemName)]),
            $timer,
            true
        );
    }

    /**
     * Sends a success notification for a deletion event.
     *
     * @param string $itemName The name of the item that was deleted (e.g., 'User', 'Role').
     * @param int|null $timer Timer duration, if different from the default.
     * @return void
     */
    protected function deletedNotification(string $itemName, ?int $timer = 5000): void
    {
        $this->sendSweetAlert(
            'success',
            __(':name deleted!', ['name' => __($itemName)]),
            __(':name has been deleted', ['name' => __($itemName)]),
            $timer,
            true
        );
    }

    /**
     * Sends a general error notification.
     *
     * @param string $title Error message title.
     * @param string $text Error message text.
     * @param int|null $timer Timer duration, if different from the default.
     * @return void
     */
    protected function errorNotification(string $title = 'Error!', string $text = 'An unexpected error occurred.', ?int $timer = 5000): void
    {
        $this->sendSweetAlert(
            'error',
            __($title),
            __($text),
            $timer,
            true // Errors usually require a confirm button
        );
    }
}
