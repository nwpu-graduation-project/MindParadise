<div>

<?php

$tags = $this->requestAction('/tags/view');
foreach ($tags as $tag) {
    echo $tag['Tag']['tag'];
    echo '&nbsp';
}

?>

</div>