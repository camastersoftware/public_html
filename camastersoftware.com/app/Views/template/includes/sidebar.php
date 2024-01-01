<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile px-10 py-15">
            <div class="d-flex align-items-center">
                <div class="image">
                    <img src="<?= esc(base_url('assets/images/washing.png')); ?>" class="avatar avatar-lg" alt="User Image">
                </div>
                <div class="info ml-10">
                    <p class="mb-0">Welcome</p>
                    <h5 class="mb-0">Admin</h5>
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?php if($uri1=="home" || $uri1==""): ?>active<?php endif; ?>">
                <a href="<?=base_url("home")?>">
                    <i class="ti-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php if($uri1=="users"): ?>active<?php endif; ?>">
                <a href="<?=base_url("users")?>">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="<?php if($uri1=="services"): ?>active<?php endif; ?>">
                <a href="<?=base_url("services")?>">
                    <i class="fa fa-th"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="<?php if($uri1=="categories"): ?>active<?php endif; ?>">
                <a href="<?=base_url("categories")?>">
                    <i class="fa fa-cube"></i>
                    <span>Cloth Categories</span>
                </a>
            </li>
            <li class="<?php if($uri1=="clothes"): ?>active<?php endif; ?>">
                <a href="<?=base_url("clothes")?>">
                    <i class="mdi mdi-tshirt-crew"></i>
                    <span>Clothes</span>
                </a>
            </li>
            <!--
            <li class="<?php if($uri1=="branch"): ?>active<?php endif; ?>">
                <a href="<?=base_url("branch")?>">
                    <i class="fa fa-building"></i>
                    <span>Branch List</span>
                </a>
            </li>
            -->
            <li class="<?php if($uri1=="slots"): ?>active<?php endif; ?>">
                <a href="<?=base_url("slots")?>">
                    <i class="fa fa-clock-o"></i>
                    <span>Slots</span>
                </a>
            </li>
            <li class="<?php if($uri1=="order"): ?>active<?php endif; ?>">
                <a href="<?=base_url("order")?>">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="<?php if($uri1=="employees"): ?>active<?php endif; ?>">
                <a href="<?=base_url("employees")?>">
                    <i class="mdi mdi-account-multiple"></i>
                    <span>Employees</span>
                </a>
            </li>
            <li class="<?php if($uri1=="banner"): ?>active<?php endif; ?>">
                <a href="<?=base_url("banner")?>">
                    <i class="mdi mdi-image"></i>
                    <span>Banner</span>
                </a>
            </li>
        </ul>
    </section>
    <div class="sidebar-footer">
        <!-- item-->
        <?php
            if($uri1=="admin")
                $logoutUrl="admin/logout";
            else
                $logoutUrl="logout";
        ?>
        <a href="<?=base_url($logoutUrl)?>" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>