<?php
    include_once __DIR__."/Data/Data/Content_Data.php";
    include_once __DIR__."/Data/Data/Post_Data.php";

    if(!isset($_SESSION))
    {
        session_start();
    }

class ContentManager
{
    private $content;
    private $post;

    public function __construct()
    {
        $this->content = new Content_Data();
        $this->post = new Post_Data();
    }

    public function GetEntries()
    {
        $result = $this->content->GetAllEntriesSortByPostID();
        $html = "";

        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<div class='card text-white bg-dark'>
                            <div class='card-header text-muted'>".$result[$i]->Name."
                                <div class='float-end'>".$result[$i]->Date."</div>
                            </div>
                            <div class='card-body'>
                            <p class='card-text'>".$result[$i]->Text."</p>
                            </div>
                        </div>";
            $html .= $previewBody;
        }
        echo $html;
    }

    public function SetEntry()
    {
        $this->content->CreateNewEntry();
    }

    
    public function GetPosts()
    {
        $result = $this->post->GetAllEntries();
        $html = "";
        
        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<tr>
                                <td>
                                    <div>
                                        <a class='fs-4' href='index.php?postid=".$result[$i]->ID."'>".$result[$i]->Title."</a>
                                    </div>
                                    <div class='text-muted fs-6'>".$result[$i]->Description."</div>
                                </td>
                                <td id='author'>".$result[$i]->Author."</td>
                                <td>".$result[$i]->Date."</td>
                            </tr>";
            $html .= $previewBody;
            }
        echo $html;
    }

    public function SetPost()
    {
        $this->post->CreateNewEntry();
        $this->content->CreateNewEntry();
    }

    public function DisplayCategories()
    {
        $result = $this->content->GetCategory();
        $html = "";
        
        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<li class='list-group-item'>
                                <h3><a href='index.php?category_id=".$result[$i]->ID."'>".$result[$i]->Name."</a></h3>
                                <div class='text-muted'>".$result[$i]->Description."</div>
                            </li>";

            $html .= $previewBody;
        }
        echo $html;
    }
}

$manager = new ContentManager();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "setcontent")
    $manager->SetEntry();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "setpost")
    $manager->SetPost();

if(isset($_REQUEST['category_id']))
    $manager->GetPosts();
else if(isset($_REQUEST['postid']))
    $manager->GetEntries();
else
    $manager->DisplayCategories();
?>