<?php $level = $this->session->userdata('level');?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="i<?=site_url()?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">e-ujian</sup></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
<?php if($level=='operator'): ?>        
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Navigasi Data Master
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">MANAJEMEN MASTER DATA</h6>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/operator">Data Operator</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/guru">Data Guru</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/kelas">Data Kelas</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/siswa">Data Siswa</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/pelajaran">Data Mata Pelajaran</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/materi">Data Materi</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/soal">Data Soal</a>
            <!-- <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/ujian">Data Ujian</a> -->
          </div>
        </div>
      </li>
<?php endif; ?>
<?php if($level=='guru'): ?>        
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Navigasi Data Master
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">MANAJEMEN MASTER DATA</h6>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/guru">Data Guru</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/siswa">Data Siswa</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/pelajaran">Data Mata Pelajaran</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/materi">Data Materi</a>
            <a class="collapse-item" href="<?=site_url()?>/Welcome/lihatData/soal">Data Soal</a>
          </div>
        </div>
      </li>
<?php endif; ?>        
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        NAVIGASI HALAMAN
      </div>
<?php if((isset($level))OR($level != '')): ?>      
     <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>/Welcome/listUjian">
          <i class="fas fa-fw fa-book"></i>
          <span>Ujian</span></a>
      </li>
<?php endif; ?>      
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>/Welcome/bacaMateri/0">
          <i class="fas fa-fw fa-list"></i>
          <span>Baca Materi</span></a>
      </li>     
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        PROFILE
      </div>
<?php if(isset($level)): ?>      
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>/Welcome/akun">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>/loginController/logout">
          <i class="fas fa-fw fa-power-off"></i>
          <span>Log Out</span></a>
      </li>
<?php else: ?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?=site_url()?>/loginController">
          <i class="fa fa-key"></i>
          <span>Login</span></a>
      </li>
<?php endif; ?>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>