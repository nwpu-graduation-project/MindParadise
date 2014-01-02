<?php
$this->start('css');
echo $this->Html->css('treeview');
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo $this->Html->script('treeview');
$this->end();
?>


<div style="width:200px; float:left; margin:0 0px 20px 0">
  	 
  <ul class="anyClass2 skinClear harmonica">
    <li><a href="#" class="harFull cur">Very long link</a>
      <ul style="display: none;">
        <li><a href="#" class="harFull cur">Clickable link One</a>

          <ul style="display: none;">
            <li><a href="#" class="harFull">Clickable link One</a>

              <ul style="">
                <li><a href="#" class="harFull">Clickable link One</a>
                  <ul style="">
                    <li><a href="#">Clickable link One</a>
                    </li>
                    <li class="last"><a href="#">Clickable link Two</a>
                    </li>
                  </ul>
                </li>
  
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#">Clickable link Two</a>
        </li>
      </ul>
    </li>

    <li><a href="#" class="harFull">Short link</a>
      <ul style="">
        <li><a href="#">Clickable link One</a></li>
        <li><a href="#">Clickable link Four</a></li>
      </ul>
    </li>
  </ul>
</div>
<hr>
