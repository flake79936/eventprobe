<?php
session_start();  
require 'fbSearcher.php';
require 'src/config.php';
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $config['App_ID'],
  'secret' => $config['App_Secret'],
  'cookie' => true
)); 
$vars = $_POST; 




if(isset($_GET['fbTrue']))
{
    $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=".$config['App_ID']."&redirect_uri=" . urlencode($config['callback_url'])
       . "&client_secret=".$config['App_Secret']."&code=" . $_GET['code']; 

     $response = file_get_contents_curl($token_url);

     $params = null;
     parse_str($response, $params);
     $_SESSION['token'] = $params['access_token'];
     $content = '<form action="index.php" method="post"> 
        <input type="text" name="q" value="'.$vars['q'].'"></input> 
        <select name="type"> 
            <option value="post">Post</option> 
            <option value="event">Event</option> 
            <option value="place">Place</option> 
            <option value="page">Page</option> 
            <option value="group">Group</option>  
        </select><input type="submit" value="search"></input></form>';
} 
elseif(isset($_POST['q']))
{
    if($_POST['q'] != "")
    {
        $searcher = new facebookSearcher(); 
        $searcher->setQuery($vars['q']) 
                ->setType($vars['type']) 
                ->setAccessToken($_SESSION['token']) 
                ->setLimit(30); 
        $graph_res = $searcher->fetchResults(); 
        if(count($graph_res->data) == 0)  exit("No Results"); 
        if($vars['type'] == 'post')
        {
            //post 
            foreach($graph_res->data as $post)
            {
                $row[] = "<img src='{$post->icon}' />".$post->type; 
                $row[] = $post->from->name; 
                $row[] = $post->message; 
                $row[] = "<a href='{$post->link}' target='_blank'>{$post->link}</a>"; 
                $row[] = $post->likes->count." Likes"; 
                $table[] = $row; 
                unset($row);
            }
        }
        elseif($vars['type'] == 'event')
        {
            foreach($graph_res->data as $post)
            {
                $row[] = $post->name; 
                $row[] = "At ".$post->location; 
                $row[] = "From ".$post->start_time." To ".$post->end_time; 
                $row[] = "<a href='https://www.facebook.com/events/{$post->id}' target='_blank'>View</a>"; 
                $table[] = $row; 
                unset($row);
            }
        }
        elseif($vars['type'] == 'place')
        {
            foreach($graph_res->data as $post)
            {
                $row[] = $post->name; 
                $row[] = $post->category; 
                $row[] = $post->location->street.", ".$post->location->city.", ".$post->location->country;
                $row[] = "<a href='https://www.facebook.com/{$post->id}' target='_blank'>View</a>";  
                $table[] = $row; 
                unset($row);
            }
        }
        elseif($vars['type'] == 'page')
        {
            foreach($graph_res->data as $post)
            {
                $row[] = $post->name; 
                $row[] = $post->category; 
                $row[] = "<a href='https://www.facebook.com/{$post->id}' target='_blank'>View</a>"; 
                $table[] = $row; 
                unset($row);
            }
        }
        elseif($vars['type'] == 'group')
        {
            foreach($graph_res->data as $post)
            {
                $row[] = $post->name; 
                $row[] = "<a href='https://www.facebook.com/{$post->id}' target='_blank'>View</a>"; 
                $table[] = $row; 
                unset($row);
            }
        }
        else
        {     
            $content .= "<h2>Nothing Found.</h2>";
        }
        $content = '<form action="index.php" method="post"> 
            <input type="text" name="q" value="'.$vars['q'].'"></input> 
            <select name="type"> 
                <option value="post">Post</option> 
                <option value="event">Event</option> 
                <option value="place">Place</option> 
                <option value="page">Page</option> 
                <option value="group">Group</option>  
            </select><input type="submit" value="search"></input></form>';        
        $content .= "<table width='800' border='1'> ";

        foreach ($table as $row){ 
            $content .= "<tr>"; 
            foreach ($row as $cell){ 
                $content .= "<td>{$cell}</td>"; 
            } 
            $content .= "</tr>"; 
        } 
        $content .= "</table> ";
    }
    else
    {
         $content .= "<h2>Search {$vars['type']}s For : {$vars['q']}</h2>";
         $content .= "<h2>Nothing Found.</h2>";
         
    }
}
else
{
     $content = '<a href="https://www.facebook.com/dialog/oauth?client_id='.$config['App_ID'].'&redirect_uri='.$config['callback_url'].'"><img src="./images/login-button.png" alt="Sign in with Facebook"/></a>';
     
}


echo $content;

?> 

