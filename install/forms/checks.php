<div class="database-config">

    <h2>Install Urania</h2>

    <div class="checks">
        
        <table>
            <tbody>
                
                <?php foreach(Install::$checks as $check => $value) { ?>
                <tr>
                    
                    <td>
                        <?php if($value === true): ?>
                            <span class="glyphicon glyphicon-ok"></span>
                        <?php else: ?>
                            <span class="glyphicon glyphicon-remove"></span>
                        <?php endif; ?>
                    </td>
                    
                    <td><?php echo $check; ?>
                        
                        <p class="check-error">
                            <?php if($value !== true): ?>
                            <?php echo $value; ?>
                            <?php endif; ?>
                        </p>
                    </td>
    
                    
                    
                </tr>    
                <?php } ?>
                
            </tbody>
        </table>
        
    </div>
    
    <p></p>
    
    
    <?php if(Install::$everything_ok): ?>
    
        <a href="./index.php?step=checks" class="pure-button pure-input-1-2 pure-button-primary"><span class="glyphicon glyphicon-refresh"></span></a>
    
        <a href="./index.php?step=database" class="pure-button pure-input-1-2 pure-button-primary">Install <span class="glyphicon glyphicon-chevron-right"></span></a>
    
    <?php else: ?>
        
        <a href="./index.php?step=checks" class="pure-button pure-input-1-2 pure-button-primary"><span class="glyphicon glyphicon-refresh"></span></a>
        
        <a class="pure-button pure-input-1-2 pure-button pure-button-disabled">Install <span class="glyphicon glyphicon-chevron-right"></span></a>
        
    <?php endif; ?>
    

</div>