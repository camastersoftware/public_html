<?= $this->extend($layoutPath); ?>

<?= $this->section('headerJavacript'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">
<!-- Main content -->
<style>
    #frame .content .messages ul li b {
        display: inline-block;
        /* padding: 1px 5px; */
        border-radius: 20px;
        max-width: 205px;
        line-height: 130%;
    }

    #frame .content .messages ul li.replies b {
        background: #f5f5f5;
        float: right;
    }

    #frame .content .messages ul li.sent b {
        background: #f5f5f5;
        float: left;
    }

    @media screen and (min-width: 735px) {
        #frame .content .messages ul li b {
            max-width: 300px;
        }
    }

    b {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .contactLi {
        list-style: none !important;
    }

    .contactLi a {
        color: #fff !important;
    }

    #frame #sidepanel #contacts ul {
        padding-left: 10px !important;
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<section class="content mt-35">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                            if (isset($pageTitle))
                                echo $pageTitle;
                            else
                                echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('users'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body tab_body_div card_bg_format">
                    <div class="row">
                        <div class="offset-md-0 offset-lg-0 col-md-12 col-lg-12">
                            <div class="tab-wizard wizard-circle staff_form" id="frame">
                                <div id="sidepanel">
                                    <div id="profile">
                                        <div class="wrap">
                                            <?php if (!empty($sessUserImg)) : ?>
                                                <img id="profile-img" src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . $sessUserImg); ?>" alt="" />
                                            <?php else : ?>
                                                <img id="profile-img" src="<?= base_url("assets/images/avatar/blank.png"); ?>" class="online" alt="" />
                                            <?php endif; ?>
                                            <p><?= checkData($sessUserFullName); ?></p>
                                        </div>
                                    </div>
                                    <div id="search">
                                        <label for="">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </label>
                                        <input id="message-input" type="text" placeholder="Search contacts..." />
                                    </div>
                                    <div id="contacts">
                                        <ul>
                                            <?php if (!empty($userListArr)) : ?>
                                                <?php foreach ($userListArr as $row) : ?>
                                                    <li class="contact contactLi <?php if ($receiverId == $row['userId']) : ?>active<?php endif; ?>" data-id="<?= $row['userId']; ?>">
                                                        <a href="<?= base_url() . '/chat/' . $row['userId']; ?>">
                                                            <div class="wrap">
                                                                <!-- <span class="contact-status online"></span> -->
                                                                <?php if (!empty($row['userImg'])) : ?>
                                                                    <img class="contactPic" src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . $row['userImg']); ?>" alt="" />
                                                                <?php else : ?>
                                                                    <img class="contactPic" src="<?= base_url("assets/images/avatar/blank.png"); ?>" alt="" />
                                                                <?php endif; ?>
                                                                <div class="meta">
                                                                    <input type="hidden" class="name contactID" value="<?= $row['userId']; ?>">
                                                                    <p class="name contactName"><?= checkData($row['userFullName']); ?> <?php if ($row['unReadMsgCount'] != 0) : ?>(<?= $row['unReadMsgCount'] ?>)<?php endif; ?></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php if (!empty($getAllUserMsg)) : ?>
                                    <!--User Messages Detials Start-->
                                    <div class="content">
                                        <div class="contact-profile">
                                            <?php if (!empty($getReceiverDetails['userImg'])) : ?>
                                                <img id="profile-img" src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . checkData($getReceiverDetails['userImg'])); ?>" alt="" />
                                            <?php else : ?>
                                                <img id="currentPic" src="<?= base_url("assets/images/avatar/blank.png"); ?>" alt="" />
                                            <?php endif; ?>

                                            <p id="currentName"><?= checkData($getReceiverDetails['userFullName']); ?></p>
                                            <input type="hidden" id="currentID" value="<?= $receiverId; ?>">
                                        </div>
                                        <div class="messages">
                                            <ul>
                                                <?php foreach($getAllUserMsg as $row2) : ?>
                                                    <li>
                                                        <center>
                                                            <p class="dateMsg">
                                                                <b><?= $row2['id'] ?></b>
                                                            </p>
                                                        </center>
                                                    </li>
                                                    <?php if(!empty($row2['msg'])): ?>
                                                        <?php foreach($row2['msg'] as $row) : ?>
                                                            <?php if($row['fromUserId'] == $sessUserId) : ?>
                                                                <li class="replies">
                                                                    <img src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . $sessUserImg); ?>" alt="" />
                                                                    <p>
                                                                        <?= $row['userMessage'] ?> 
                                                                        <small style="color:#4f4646">
                                                                            <?= date('h:i a', strtotime($row['createdDatetime'])); ?>
                                                                        </small>
                                                                    </p>
                                                                    <br />
                                                                </li>
                                                            <?php else : ?>
                                                                <li class="sent">
                                                                    <img src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . checkData($getReceiverDetails['userImg'])); ?>" alt="" />
                                                                    <p>
                                                                        <?= $row['userMessage'] ?> 
                                                                        <small>
                                                                            <?= date('h:i a', strtotime($row['createdDatetime'])); ?>
                                                                        </small>
                                                                    </p>
                                                                    <br />
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="message-input">
                                            <div class="wrap">
                                                <input type="text" placeholder="Write your message..." />
                                                <!--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>-->
                                                <button class="submit" id="sendWSMsg">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--User Messages Detials End-->

                                <?php else : ?>

                                    <!--No Content Detials Start-->
                                    <div class="no-content content">
                                        <div class="contact-profile">

                                            <?php if (!empty($getReceiverDetails)) : ?>
                                                <?php if (!empty($getReceiverDetails['userImg'])) : ?>
                                                    <img id="profile-img" src="<?= base_url("uploads/ca_firm_" . $sessCaFirmId . "/documents/" . checkData($getReceiverDetails['userImg'])); ?>" alt="" />
                                                <?php else : ?>
                                                    <img src="<?= base_url("assets/images/avatar/blank.png"); ?>" alt="" />
                                                <?php endif; ?>

                                                <?php if (!empty($getReceiverDetails['userFullName'])) : ?>
                                                    <p id="currentName"><?= checkData($getReceiverDetails['userFullName']); ?></p>
                                                <?php endif; ?>

                                            <?php endif; ?>

                                            <input type="hidden" id="currentID" value="<?= $receiverId ?>">
                                           
                                        </div>
                                        <div class="messages">
                                            <b>
                                                <center>
                                                    <h4 class="mt-40">No Messages Found !</h4>
                                                </center>
                                            </b>
                                        </div>
                                        <?php if (!empty($getReceiverDetails)) : ?>
                                            <div class="message-input">
                                                <div class="wrap">
                                                    <input type="text" placeholder="Write your message..." />
                                                    <!--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>-->
                                                    <button class="submit" id="sendWSMsg">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!--No Content Detials End-->

                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- end container -->

<?= $this->endSection(); ?>

<?= $this->section('javacript'); ?>

<script src="<?php echo base_url('assets/js/chat_js.js'); ?>"></script>
<script>
    // Use jQuery document ready function
    $(document).ready(function() {
        scrollToBottom();
        // Scroll to the send message button after sending a message
        function scrollToBottom() {
            // Get the send message button element
            var sendMessageButton = document.getElementById('sendWSMsg');

            // Scroll the messages container to the position of the send message button
            sendMessageButton.scrollIntoView({
                behavior: 'smooth',
                block: 'end',
                inline: 'nearest'
            });
        }
    });
</script>
<?= $this->endSection(); ?>