<?php $this->start('css'); ?>
<style>
	div.option {
		height: 36px;
		display: inline-block;
	}
	
	div.questionContainer {
		margin-top: 10px;
		margin-bottom: 10px;
		display: block;
		width: 600px;
		float: none;
	}
	
	p.question {
		font-size: 1.35em;
		padding: 5px 0px 5px 0px;
		margin-left: 15px;
		margin-bottom: 10px;
	}

	div input[type=radio] {
		opacity: 0;
		display: inline;
	}

	div label {
		width: 200px;
		display: inline;
		font-size: 1.35em;
		padding: 5px 5px 5px 10px;
		height: 20px;
		z-index: 9;
		background: rgba(128,128,128,0.15);
		cursor: pointer;
	}

	div label:hover {
		background: rgba(128,128,128,0.45);
	}

	div .check {
		display: block;
		border: 2px solid #FFF;
		border-radius: 100%;
		height: 15px;
		width: 15px;
		top: 38%;
		left: 6%;
	}

	div input[type=radio]:checked ~ label {
		color: rgba(25, 25, 165, 0.66);
		background: rgba(128,128,128,0.65);
	}

</style>
<?php $this->end(); ?>

<div id="blog_content">
	<div class="center_frame">

		<div id="blog_left">
			<?php echo $this->element('artical_categories',
					array('current' => 6)); ?>
		</div>

		<div id="blog_right">
			<div class="post_blog">
				<h2><?php echo 'title'; ?></h2>

				<div calss="content_view">

					<form action="/webcontents/test" method="post">

						<?php for($i=0;$i<6;$i++) { ?>
						<div class="questionContainer">
							<p class="question">
								What kind of pet would you like to keep What kind of pet would you like to keep What kind of pet
								would you like to keep?
							</p>

							<div class="option">
								<input type="radio" id="q-<?php echo $i; ?>-1" name="data[q-<?php echo $i; ?>]" value="1">
								<label for="q-<?php echo $i; ?>-1">I'd like a cat.</label>
							</div>
							<div class="option">
								<input type="radio" id="q-<?php echo $i; ?>-2" name="data[q-<?php echo $i; ?>]" value="2">
								<label for="q-<?php echo $i; ?>-2">A dog maybe.</label>
							</div>
							<div class="option">
								<input type="radio" id="q-<?php echo $i; ?>-3" name="data[q-<?php echo $i; ?>]" value="3">
								<label for="q-<?php echo $i; ?>-3">I'd like a rabbit.</label>
							</div>
							<div class="option">
								<input type="radio" id="q-<?php echo $i; ?>-4" name="data[q-<?php echo $i; ?>]" value="4">
								<label for="q-<?php echo $i; ?>-4">A horse, nice!</label>
							</div>
						</div>
						<?php } ?>
						<input type="submit" value="提交"/>

					</form>

					<div>
						<?php if(!empty($result)) echo $result;
						?>
						<?php if(!empty($description)) echo $description; ?>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div id="page_navigation">
	<div class="center_frame">
		<a href="/webcontents/index" class="leave_back">&nbsp;</a>
	</div>
</div>