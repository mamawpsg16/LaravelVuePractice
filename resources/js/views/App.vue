<template>
    <div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-widget="pushmenu"
                        href="#"
                        role="button"
                        ><i class="fas fa-bars"></i
                    ></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-widget="fullscreen"
                        href="#"
                        role="button"
                    >
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a
                        class="nav-link"
                        data-widget="control-sidebar"
                        data-controlsidebar-slide="true"
                        href="#"
                        role="button"
                    >
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
             <router-link :to="{ name: 'home' }">
                    <a class="brand-link">
                        <img
                            src="dist/img/AdminLTELogo.png"
                            alt="AdminLTE Logo"
                            class="brand-image img-circle elevation-3"
                            style="opacity: 0.8"
                        />
                        <span class="brand-text font-weight-light"
                            >Laravel Vue Practice</span
                        >
                    </a>
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
               
                <!-- Sidebar Menu -->
                
                <!-- /.sidebar-menu -->
                <sidebar></sidebar>
            </div>
            <!-- /.sidebar -->
        </aside>

        <router-view></router-view>
    </div>
</template>
<script>
import Sidebar from "./sidebars/Sidebar";
export default {
    name: "App",
    components: {
        'sidebar': Sidebar
    },
};
</script>
<style></style>
