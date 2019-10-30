<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo ($this->router->fetch_method() == 'index') ? 'Login' : 'Register'; ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">        
        <link rel="stylesheet" href="<?php echo base_url('static/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('static/css/AdminLTE.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('static/css/skins/skin-blue.min.css'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
