<?php

    
    
    add_action('admin_menu','adminPage');

   
  
    function adminPage()
    {

        $data = rest_data();
        add_menu_page('Bookmakers Shortcode Generator', 'Bookmakers Shortcode', 'manage_options', 'shortcode_generator', 'adminHTML');
       
    }


    function adminHTML()
    {
        
    ?>

        <div class="flex-wrap col-12">
            <h1>Plug Settings</h1>
            <form action="" " method="">

            <div class=" form-group col-4">
                <label for="results_short" class="lead">Αποτελέσματα Shortcode</label>
                <input class="form-control " type="text" name="results_short" value="<?php  ?>">
        </div>
        <div class="form-group col-2  ">
            <label for="order_by" class="h5">Order By</label>
            <select name="order_by" id="sorting_by" onchange="show()">
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
                <option value="sorting_id" data-toggle="collapse"data-target="#demo">Sorting by ID</option>
                
            </select>
            <div id="demo" class="collapse">
                <table>
                    <tr>
                        <td>
                        <?php

                      

                        ?>
                        
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="form-group col-1">
            <label for="limit_short" class="h5">Limit</label>
            <input class="form-control " type="text" name="limit_short" value="<?php  ?>">
        </div>

      
            </form>
        </div>
    <?php
    }
    ?>
