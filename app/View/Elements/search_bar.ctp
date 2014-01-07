<?php $this->start('css'); ?>

<style>

@import "compass";

$dark-red: #a01f4a;

.search {
  position: relative;
  width: 100%;
}
.searchTerm {
  /* position: absolute; */
  top: 0;
  left: 0;
  width: 95%;
  -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
  -moz-box-sizing: border-box;    /* Firefox, other Gecko */
  box-sizing: border-box; 
  height: 35px;
  border: 5px solid $dark-red;
  border-radius: 5px;
  outline: none;
  padding: 5px 45px 5px 5px;
  @include transition(all .15s ease-in-out);
  &:hover {
	border: 2px solid $dark-red;
  }
  &:focus {
  	border: 2px solid darken( $dark-red, 10%);
  }  
}
.searchButton,
.searchIcon {
  display: block;
  position: absolute;
  top: 0;
  right: 0;
  width: 40px;
  height: 40px;
  line-height: 40px;
  font-family: 'FontAwesome';
  background: $dark-red;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  -webkit-font-smoothing: subpixel-antialiased;
  font-smooth: always;
  cursor: pointer;
}
.searchButton {
  opacity: 0;
  z-index: 1;
}

.searchIcon{
  @include transition(all .15s ease-in-out);
      &:hover {
     background: darken($dark-red, 10%);    
      }
}
.searchIcon:before {
  content: '\f002';
}
</style>

<?php $this->end(); ?>

<div id="" class="blog_side_bg" style="width 209; padding: 7px 7px 7px 7px;">

<form class="search" action="/search/" method="post" style="width 209;">
	<input class="searchTerm" name="data[keyword]" placeholder="输入关键词，按回车搜索" />
	<select name="data[type]" id="searchType" required="required" value="1">
		<option value="0">全站</option>
		<option value="1" selected="selected">心理知识</option>
		<option value="2">心理百科</option>
	</select>
	<input type="submit" value="搜索"/>
</form>

</div>