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

    public function GetContent()
    {
        $result = $this->content->GetAllEntriesSortDesc();
        $html = "";

        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<div class='card'>
                            <div class='card-header'>".$result[$i]->Name."
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

    public function SetContent()
    {
        $this->content->CreateNewEntry();
    }

    public function SetPost()
    {
        $this->post->CreateNewEntry();
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
                                        <a href=''>".$result[$i]->Title."</a>
                                    </div>
                                    <div class='text-muted'>".$result[$i]->Description."</div>
                                </td>
                                <td>".$result[$i]->Author."</td>
                                <td>".$result[$i]->Date."</td>
                            </tr>";
            $html .= $previewBody;
        }
        echo $html;
    }
}

$manager = new ContentManager();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "setcontent")
{
    $manager->SetContent();
}

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "setpost")
{
    $manager->SetPost();
}

$manager->GetPosts();
?>