<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Lavandería "My Princess"</title>
  <!-- Fuentes de letras -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/estilo_editar.css">
  <link rel="stylesheet" type="text/css" href="css/css/animation.css">
  <!-- Estilos para la plantilla -->
  <link href="css/sb-admin-2.css" rel="stylesheet">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">      
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="icon-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php if($_SESSION['tipo_cliente'] == 2){ echo "Cliente"; }
        elseif($_SESSION['tipo_cliente'] == 1){ echo "Socio"; } ?></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="icon-signal"></i>
          <span>Lavandería my princess</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Sistema
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsed-usuario" aria-expanded="true" aria-controls="collapseTwo">
          <i class="icon-user"></i>
          <span><?php echo $_SESSION['nombre_cliente']; ?></span>
        </a>
        <div id="collapsed-usuario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones de usuario:</h6>
            <a class="collapse-item" href="#">Editar mi perfil</a>
            <a class="collapse-item" href="cerrar_sesion.php">Cerrar sesión</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider"> 
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-servicio" aria-expanded="true" aria-controls="collapseTwo">
          <i class="icon-briefcase"></i>
          <span>Servicios</span>
        </a>
        <div id="collapse-servicio" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones de servicios:</h6>
            <a class="collapse-item" href="servicios.php">Listar servicios</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-reserva" aria-expanded="true" aria-controls="collapseTwo">
          <i class="icon-folder-open"></i>
          <span>Mis reservas</span>
        </a>
        <div id="collapse-reserva" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones de reservas:</h6>
            <a class="collapse-item" href="reservas.php">Ver mis reservas</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <?php echo 'FECHA DEL SISTEMA'.' | '.date('d-m-Y') ?>
          </ul>
        </nav>
        <!-- End of Topbar -->