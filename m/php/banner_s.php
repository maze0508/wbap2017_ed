<?php 

        echo "<nav class='nav'><ul><li id='ald' style='height:50px;'><h3>".$_SESSION['user_name']." 同學</h3></li>
        <li>
            <a href='group_study.php' accesskey='2' title='學習主題'>學習主題</a>
        </li>
        <li>
        	 <a href='start_learning_0_3.php' accesskey='2' title='我的收藏'>我的收藏</a>    
        </li>
		<li><a href='group_study_note.php?page=1' accesskey='4' title='我的註記'>我的註記</a></li>
		<li><a href='learning_books_list.php' accesskey='4' title='筆記本'>筆記本</a></li>       
		<li><a href='../php/logout.php' title='登出'>登出</a></li>               
    </ul></nav>"
	?>