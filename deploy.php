<?php
$commands = array(
    // 'echo $PWD',
    // 'whoami',
    'git pull',
    'git status',
    'git submodule sync',
    'git submodule update',
    'git submodule status',
);
if (isset($_GET['code']) && $_GET['code'] == 'sU3AqhDnLIX4LhHr2obu') {
    $output = '';
    foreach ($commands as $command) {
        $tmp = shell_exec($command);
        $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
        $output .= htmlentities(trim($tmp)) . "\n";
    }
} else {
    $output .= 'Direct deploy is not allowed';
}
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>

<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
    <pre>
 .  ____  .    ____________________________
 |/      \|   |                            |
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
 |___==___|  /
              |____________________________|

<?php echo $output; ?>
</pre>
</body>

</html>