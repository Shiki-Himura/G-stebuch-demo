<?php
    include_once __DIR__."/Data/Data/Content_Data.php";
    include_once __DIR__."/Data/Data/Post_Data.php";
    include_once __DIR__."/AccountManager.php";

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
            $previewBody = "<div class='card text-light bg-dark'>
                            <div class='card-header text-muted'>".$result[$i]->username."
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

    public function GetAllEntriesAsCount()
    {
        $account = new AccountManager();
        if(!$account->ValidateAvailabilityForUserProfiles($username = $_GET['username']))
            $username = "Invalid User!";
        else
            $username = $_GET['username'];

        $result = $this->content->GetEntryCount();
        $userprofile = "";

        for ($i = 0; $i < Count($result); $i++)
        { 
            $previewBody = "
                            <div class='d-flex flex-column mt-5 text-white'>
                                <h1><u>Profile</u></h1>
                                <div class='fs-4'>Username: ".$username."</div>
                                <div class='fs-4'>Posts: ".$result[0]->postcount."</div>
                            </div>";
            $userprofile .= $previewBody;
        }
        echo $userprofile;
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
                                <td id='author' class='usernamedisplay'>".$result[$i]->Author."</td>
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

    public function UpdateOrder()
    {
        $this->content->UpdateCategoryOrderID();
    }

    public function DisplayCategories()
    {
        $result = $this->content->GetCategory();
        $html = "";
        
        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<li class='list-group-item list-group-item-dark border-dark'>
                                <h3><a href='index.php?category_id=".$result[$i]->ID."'>".$result[$i]->Name."</a></h3>
                                <div class='text-muted'>".$result[$i]->Description."</div>
                            </li>";

            $html .= $previewBody;
        }
        echo $html;
    }

    public function GetCategoryNames()
    {
        $result = $this->content->GetCategory();
        $html ="
                    <div class='row'>
                        <div class='col-4'>
                            <label>Choose a Category:</label>
                            <select class='float-end' name='categories' id='categories'>";
        
        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<option value='".$result[$i]->Name."'>".$result[$i]->Name."</option>";
            $html .= $previewBody;
        }

        $html .= "
                        </select>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-4'>
                        <label>Category order value: </label>
                        <input class='float-end' id='order' type'text' placeholder='Current Range = 1-10000'></input>
                    </div>
                </div>
            <div class='row'>
                <div class='col-4'>
                    <button class='btn btn-danger' id='update_category_order'>Submit Changes</button>
                </div>
            </div>";
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
else if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == "/g%C3%A4stebuch-demo/index.php")
    $manager->DisplayCategories();

if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin' && isset($_REQUEST['Administration']) && $_REQUEST['Administration'] == 'admin_settings')
{
    $manager->GetCategoryNames();
    exit();
}

if(isset($_REQUEST['options']) && $_REQUEST['options'] == 'changeOrder')
    $manager->UpdateOrder();


if($_SERVER['REQUEST_URI'] == "/g%C3%A4stebuch-demo/userprofile.php?username=".(isset($_GET['username']) ? $_GET['username'] : $_SESSION['valid_user'])."")
    $manager->GetAllEntriesAsCount();
?>