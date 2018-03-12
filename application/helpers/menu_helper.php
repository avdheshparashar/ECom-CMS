<?php
    function menu($array=array()) {
        if (count($array)) {
            echo "<ul id='' class=''>";
            foreach ($array as $vals) { ?>
                <li>
                    <a href='<?php echo base_url(); ?>category/<?php echo $vals['slug'];?>'><?php echo $vals['category_name']; ?>
                </a>
                
                <?php
                if (count($vals['children'])) {
                    echo menu($vals['children']);
                }
                echo "</li>";
            }
            echo "</ul>";
        }
    }
?>
