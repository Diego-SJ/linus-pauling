<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/custom_theme.css">
</head>
<body>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
                </td>
                <td><span class="badge bg-red">55%</span></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                </div>
                </td>
                <td><span class="badge bg-yellow">70%</span></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                </div>
                </td>
                <td><span class="badge bg-light-blue">30%</span></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                </div>
                </td>
                <td><span class="badge bg-green">90%</span></td>
            </tr>
        </tbody>
    </table>
</body>
</html>