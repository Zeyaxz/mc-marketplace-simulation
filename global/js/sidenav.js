    
    let redem1 = document.getElementById("redeem1");
    let redem2 = document.getElementById("redeem2");
    function redem() {
        if (redem1.value.length == redem1.maxLength) {
            redem1.nextElementSibling.focus();
        }
    };
    function redemm() {
        if (redem2.value.length == redem2.maxLength) {
            redem2.nextElementSibling.focus();
        }
    };


let btn_back = document.getElementById("btn_back");
let btn = document.getElementById("btn");
let list = document.getElementById("list");
let profile = document.getElementById("profile");
let edit_img = document.querySelector(".edit_img");

function edit() {
    btn_back.innerHTML="<a onclick=\"btnn()\"></a><h2>Edit Profile</h2>";
    edit_img.style.display="none";
    btn.style.display="none";
    list.style.display="none";
    profile.style.display="flex";
}

function btnn() {
    btn_back.innerHTML="<a href=\"marketing.php\"></a><h2>Profile</h2>";
    edit_img.style.display="block";
    btn.style.display="block";
    list.style.display="flex";
    profile.style.display="none";
}

function editimg(){
    document.getElementById('edit-img').classList.toggle("luar-list");
    document.getElementById('tes').addEventListener(
    "mouseout",
    (e) => {
        document.getElementById('edit-img').classList.add("luar-list");
    }
    );
}
