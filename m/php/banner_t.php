<?php 
        echo "
		<nav class='nav'><ul><li id='ald' style='height:50px;'><h3>".$_SESSION['user_name']." 老師</h3></li>
    
        <li>
            <a href='#'  title='教材管理'>教材管理</a>
            <ul>
                <li><a href='../sign.php' title='我的教材'>我的教材</a></li>
                <li><a href='../books_list.php' title='教材資源'>教材資源</a></li>
            </ul>
        </li>
        <li>
        	 <a href='#' title='影片管理'>影片管理</a>  
              <ul>

                <li><a href='../upload_media.php' title='新增影片'>新增影片</a></li>
                <li><a href='../temp_media.php' title='草稿夾'>影片草稿夾</a></li>                <li><a href='../my_media.php' title='草稿夾'>我的影片</a></li>
             </ul>  
        </li>
         <li>
            <a href='#'  title='學生管理'>學生管理</a>
            <ul>
                <li><a href='../team.php' title='學習主題'>學習主題</a></li>
                <li><a href='../my_learning_list.php' title='課堂分組'>課堂分組</a></li>
            </ul>
        </li>
		<li><a href='my_favorite.php'  title='我的收藏'>我的收藏</a></li>       
		<li><a href='../php/logout.php' title='登出'>登出</a></li>               
    </ul>"
	?>