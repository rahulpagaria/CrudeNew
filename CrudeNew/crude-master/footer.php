<?php
//
$copyYear = 2008; // Sets website start date
$curYear = date('Y'); // Keeps the second year updated
                      // <p>Copyright &copy; <?php echo date("Y");// my business name. All rights reserved.</p>
echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
?> Copyright.&copy; 