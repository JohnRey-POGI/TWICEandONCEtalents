<?php
session_start();

$title = "Contact";
$content = '<div id="postcontent"><br>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dolor justo, commodo at sollicitudin sed, condimentum non urna. Donec vulputate ligula eu efficitur lacinia. Nam a arcu id mauris suscipit sollicitudin. Maecenas scelerisque lectus eu nisl sodales, id maximus neque fermentum. Nullam pulvinar ornare enim sit amet tincidunt. Ut fringilla et elit vitae tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque posuere nunc velit, et placerat turpis finibus id.
<br><br>
Sed nec libero porta, consequat augue eget, ullamcorper tellus. Donec at scelerisque dolor, ut rutrum turpis. Nulla maximus justo sed est pellentesque, ac laoreet est vestibulum. Nullam posuere, nulla a scelerisque consequat, odio sem vehicula magna, id malesuada tellus justo sed tortor. Proin tempus nunc ante, in ultricies massa rutrum vel. Ut tristique velit euismod, auctor justo sit amet, placerat erat. Etiam rhoncus ex mauris, vitae semper augue pharetra sed. Vivamus dignissim sagittis turpis non pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam volutpat quam nibh, in tincidunt nunc euismod ut.
<br><br>
Suspendisse vitae fermentum enim, ut tristique ante. Duis non libero tortor. Etiam quis ipsum turpis. Donec consectetur varius ex, ac aliquam turpis cursus ac. Donec feugiat, enim non ultricies faucibus, erat urna ultrices sem, vitae auctor justo elit id est. Quisque maximus ante a ligula condimentum eleifend. Praesent eu aliquet metus, sit amet cursus ligula. Quisque ex velit, commodo a eros vitae, congue pellentesque lorem. Nullam nisi leo, volutpat id dolor sit amet, condimentum commodo neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce sed felis ornare, lobortis sem eu, gravida eros. Vestibulum libero elit, egestas et gravida quis, eleifend in risus. Nulla imperdiet ipsum libero, non ultrices leo malesuada eu. Proin ultrices, dui at congue dapibus, justo neque rhoncus dolor, et ultricies nunc enim eu ante. Duis purus odio, ultricies et hendrerit vitae, dignissim et enim. Cras congue purus id luctus feugiat.
<br><br>
Nunc porttitor posuere eros sed cursus. Suspendisse ac sapien luctus, tempor nisi sed, maximus lacus. Aenean molestie justo eu tempor cursus. Donec congue accumsan porta. Morbi egestas turpis vitae nunc vulputate lobortis. Aliquam magna risus, porta sed auctor quis, vulputate sed ligula. Quisque sed lacus orci. Phasellus hendrerit orci ut ipsum aliquam tincidunt. Nulla neque lorem, blandit efficitur convallis nec, sagittis a massa. Mauris vulputate congue purus vel tristique. Nullam sit amet felis non leo dictum mattis. Cras at iaculis mauris, sed condimentum mauris. Ut tempor tristique efficitur. Phasellus bibendum vulputate augue in dictum. Aenean vitae molestie ante. Nam volutpat sit amet enim porttitor tincidunt.
<br><br>
Pellentesque ultrices, elit id rutrum laoreet, risus ante interdum velit, eget dapibus ipsum dui non nunc. Praesent dapibus pretium rhoncus. Ut bibendum finibus arcu, ut interdum nulla ultrices quis. Etiam imperdiet, erat sed pulvinar venenatis, tellus odio dapibus felis, a malesuada sapien diam laoreet sapien. Nullam finibus consectetur leo sit amet elementum. Sed sodales, mauris luctus feugiat placerat, ipsum arcu elementum dolor, sit amet aliquet tellus eros in ipsum. Sed egestas tortor blandit, blandit nisl vitae, mollis libero. Mauris hendrerit facilisis dolor, sit amet fringilla orci commodo non. Proin quis placerat magna, lobortis elementum felis. Vestibulum faucibus vel est at volutpat. Ut a ultricies purus. Nullam fermentum, ante non condimentum ultricies, tellus ex tincidunt enim, vel molestie urna elit eu magna. Sed lobortis vitae ante at gravida. Suspendisse ut est rutrum, pellentesque velit id, pretium orci. Nunc mattis dui ac augue dapibus, nec ultrices ipsum tempor.
</div>
';

if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    include 'UserMasterPage.php';     
} else {
    include 'MasterPage.php';     
}
?>