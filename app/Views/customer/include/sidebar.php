<?php
$uris = service('uri');
$uri2 = $uris->getSegment(2);
?>
<style>
    .sub-menu-icon {
        width: 8px;
        margin: 0 0.3rem 0 1rem;
    }

    /* .treeview-menu>li:hover+.sub-menu-icon {
    color: auto;
} */
</style>
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class='<?php echo $uri2 == 'myorders' ? 'active' : '' ?>'>
                        <a href='<?php echo base_url('customer/myorders') ?>'>
                            <i data-feather='briefcase'></i>
                            <span>My Orders</span>
                        </a>
                    </li>
                    <li class='<?php echo $uri2 == 'mywishlist' ? 'active' : '' ?>'>
                        <a href='<?php echo base_url('customer/mywishlist') ?>'>
                            <i data-feather='heart'></i>
                            <span>My Wishlist</span>
                        </a>
                    </li>
                    <li class='<?php echo $uri2 == 'notifications' ? 'active' : '' ?>'>
                        <a href='<?php echo base_url('customer/notifications') ?>'>
                            <i data-feather='bell'></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li class='<?php echo $uri2 == 'reviewAndRating' ? 'active' : '' ?>'>
                        <a href='<?php echo base_url('customer/reviewAndRating') ?>'>
                            <i data-feather='star'></i>
                            <span>Review & Ratings</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='#'>
                            <i data-feather='settings' style=''></i>
                            <span>Account Setting</span>
                            <span class='pull-right-container'>
                                <i class='fa fa-angle-right pull-right'></i>
                            </span>
                        </a>
                        <ul class='treeview-menu'>
                            <li class='sub-menu-tab <?php echo $uri2 == 'profile' ? 'active' : '' ?>'>
                                <a href='<?php echo base_url('customer/profile') ?>'>
                                    <i data-feather='circle' class='sub-menu-icon <?php echo $uri2 == 'profile' ? '' : 'text-white' ?>'></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class='sub-menu-tab <?php echo $uri2 == 'manageaddress' ? 'active' : '' ?>'>
                                <a href='<?php echo base_url('customer/manageaddress') ?>'>
                                    <i data-feather='circle' class='sub-menu-icon <?php echo $uri2 == 'manageaddress' ? '' : 'text-white' ?>'></i>
                                    <span>Manage Address</span>
                                </a>
                            </li>
                            <li class='sub-menu-tab <?php echo $uri2 == 'settings' ? 'active' : '' ?>'>
                                <a href='<?php echo base_url('customer/settings') ?>'>
                                    <i data-feather='circle' class='sub-menu-icon <?php echo $uri2 == 'settings' ? '' : 'text-white' ?>'></i>
                                    <span>Other Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>