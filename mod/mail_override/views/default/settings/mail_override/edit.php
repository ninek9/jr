<?php
    $send_user = $vars['entity']->send_user;
    if (!isset($send_user)) {
        $send_user = 2;
    }

    echo "<p>";
    echo "User guid to send email to: ";
    echo elgg_view('input/text', array(
                                        'internalname' => 'params[send_user]',
                                        'value' => $send_user,
                                        'class' => ' ',
                                    ) );
    echo '</p>';
?>