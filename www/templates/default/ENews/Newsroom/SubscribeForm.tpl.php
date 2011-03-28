<?php
$subscribeBoxSet = false;
foreach ($context->getEmails() as $email) :
    if ($email->optout) :
        if (!$subscribeBoxSet) : ?>
        <div class="subscribe">
        <h3><?php echo $context->name; ?><span>Subscribe Today!</span></h3>
        <?php endif; ?>
        <form method="get" action="http://listserv.unl.edu/signup-anon/" id="subscribe">
            <label for="address">Email</label>
            <input type="text" id="address" name="ADDRESS" value="" />
            <input type="hidden" value="<?php echo $context->getURL().'?subscribed';?>" name="SUCCESS_URL" />
            <input type="hidden" value="BOTH" name="LOCKTYPE" />
            <input type="hidden" name="LISTNAME" value="<?php echo substr($email->email, 0, strpos($email->email, '@')); ?>" />
            <input type="submit" value="Subscribe" name="submit" />
        </form>
        <?php if (!$subscribeBoxSet) : ?>
        </div>
        <?php $subscribeBoxSet = true;
        endif;
    endif;
endforeach;
