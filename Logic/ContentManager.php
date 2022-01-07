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
            $previewBody = "<div class='card text-light bg-dark mb-2'>
                                <div class='card-header text-muted d-flex justify-content-between'>
                                    <a class='usernamedisplay' href='userprofile.php?username=".$result[$i]->username."'>".$result[$i]->username."</a>
                                    <div>".$result[$i]->Date."</div>
                                </div>
                                <div class='card-body'>
                                    <div class='card-text'>".$result[$i]->Text."</div>
                                </div>
                            </div>";
            $html .= $previewBody;
        }
        echo $html;
    }

    public function GetProfile($username)
    {
        // Get Info about User and build Profile
        $profilearray = $this->content->GetUserProfileInfo();
        $userprofile = "";
        $profilelogout = "<div class='row profile_link'>
                            <a class='fs-4' id='logout_user_profile' href='javascript:void(0)'>Logout</a>
                        </div>";

        for ($i = 0; $i < Count($profilearray); $i++)
        {
            $previewBody = "
        <div class='row text-white'>
            <div class='col-2'>
                <div class='row profile_image_large'>
                    <img class='profileimg' src='img/smallprofpic.png'></img>
                </div>
                <div class='row profile_link'>
                    <a class='fs-4' href='userprofile.php?username=".$_GET['username']."'>Profile</a>
                </div>
                <div class='row profile_link'>
                    <a class='fs-4' href='#'>Sample</a>
                </div>
                <div class='row profile_link'>
                    <a class='fs-4' href='#'>Sample</a>
                </div>
                ".($_GET['username'] == $_SESSION['valid_user'] ? $profilelogout : null)."
            </div>
            <div class='col'>
                <div class='row'>
                    <h1>
                        Profile
                    </h1>
                </div>
                <div class='row'>
                    <div class='col'>
                        <div class='fs-5'>
                            Username: ".$username."
                            <div>test</div>
                        </div>
                        <div class='fs-5'>
                            Posts: 
                            <a href='#'>".$profilearray[$i]->postcount."</a>
                        </div>
                    </div>
                </div>
                <div class='row' id='profile_posts'>
                    <div class='col'>
                        ".$this->GetAllEntriesFromProfile()."
                    </div>
                </div>
            </div>
        </div>";
            $userprofile .= $previewBody;
        }
        echo $userprofile;
    }

    public function GetAllEntriesFromProfile()
    {
        $result = $this->content->GetProfileEntries();
        $profile_entry = "";

        for($i = 0; $i < Count($result); $i++)
        {
            $previewBody = "<div class='card text-light bg-dark mb-2'>
                                <div class='card-header text-muted d-flex justify-content-between'>
                                    <div class='usernamedisplay'>".$result[$i]->username."</div>
                                    <div>".$result[$i]->Date."</div>
                                </div>
                                <div class='card-body'>
                                    <div class='card-text'>".$result[$i]->Text."</div>
                                </div>
                            </div>";
            $profile_entry .= $previewBody;
        }
        return $profile_entry;
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
                                        <a class='fs-4 post_topic' href='index.php?postid=".$result[$i]->ID."'>".$result[$i]->Topic."</a>
                                    </div>
                                    <div class='text-muted fs-6'>".$result[$i]->Description."</div>
                                </td>
                                <td id='author' class='usernamedisplay'>
                                    <div>
                                        <a href='userprofile.php?username=".$result[$i]->Author."'>".ucwords($result[$i]->Author)."</a>
                                    </div>
                                </td>
                                <td id='date'>
                                    <div>
                                        ".$result[$i]->Date."
                                    </div>
                                </td>
                            </tr>";
            $previewBody = str_replace(['<p>','</p>'], '', $previewBody);
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
            $previewBody = "<li class='list-group-item list-group-item-dark col-5 border-dark'>
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
{
    $account = new AccountManager();
    if(!$account->ValidateAvailabilityForUserProfiles($username = $_GET['username']))
        $username = "Invalid User!";
    else
        $username = ucwords($_GET['username']);
    $manager->GetProfile($username);
    //$manager->GetAllEntriesFromProfile();
}
?>