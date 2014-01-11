<?php $this->start('css'); ?>
<style>
div .option {
	height: 36px;
}
div input[type=radio]{
	opacity: 0;
	display: inline;
}

div label{
  display: inline;
  font-size: 1.35em;
  padding: 5px 5px 5px 10px;
  height: 20px;
  z-index: 9;
  background: rgba(128,128,128,0.15);
  cursor: pointer;
}

div label:hover{
  background: rgba(128,128,128,0.45);
}

div .check{
  display: block;
  border: 2px solid #FFF;
  border-radius: 100%;
  height: 15px;
  width: 15px;
  top: 38%;
  left: 6%;
}

div input[type=radio]:checked ~ label{
  color: rgba(25, 25, 165, 0.66);
  background: rgba(128,128,128,0.65);
}

</style>
<?php $this->end(); ?>

  <div class="option">
    <input type="radio" id="f-option" name="selector">
    <label for="f-option">Do you like Cat</label>
  </div>
  <div class="option">
    <input type="radio" id="s-option" name="selector">
    <label for="s-option">Do you like Dog</label>
  </div>