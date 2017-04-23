<?php 
        echo "
		<nav class='nav'><ul><li id='ald' style='height:50px;'><h3>".$_SESSION['user_name']." 您好</h3></li>
    
        <li>
            <a href='#'  title='學習管理'>學習管理</a>
            <ul>
				<li><a href='../manager_learning_list.php' title='學生學習歷程'>學生學習歷程</a></li>
                <li><a href='../record.php' title='影片關聯分析'>影片關聯分析</a></li>
            </ul>
        </li>
        <li>
        	 <a href='#' title='課程管理'>課程管理</a>  
              <ul>
                <li><a href='../create_course.php' title='建立課程'>建立課程</a></li>
                <li><a href='../manger_course.php' title='課程管理'>課程管理</a></li>
				<li><a href='../subject.php' title='科目管理'>科目管理</a></li>
             </ul>  
        </li>
        <li>
        	 <a href='#' title='影片管理'>影片管理</a>  
              <ul>
                <li><a href='../upload_media.php' title='新增影片'>新增影片</a></li>
                <li><a href='../temp_media.php' title='草稿夾'>影片草稿夾</a></li>
				<li><a href='../my_media.php' title='我的影片'>我的影片</a></li>
             </ul>  
        </li>
         <li>
            <a href='#'  title='帳號管理'>帳號管理</a>
            <ul>
                <li><a href='../upload_teach.php' title='教師匯入/新增'>教師匯入/新增</a></li>
                <li><a href='../upload_stue.php' title='學生匯入/新增'>學生匯入/新增</a></li>
                <li><a href='../manger_data.php' title='教師/學生 管理'>教師/學生 管理</a></li>
            </ul>
        </li>
		<li><a href='../php/logout.php' title='登出'>登出</a></li>               
    </ul>"
	?>