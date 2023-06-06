function login(){

    // let username=document.getElementById("username");= sirf ye likhne se function keval run hota hai 
    // let username=document.getElementById("username").value; = .value lagane pe value milta hai 
    let username=document.getElementById("username").value;
    let password=document.getElementById("password").value;


    if (username=='GOLUKR'&& password=='GOLU123') {
        console.log('login succesfully');
        location.assign('https://www.dominos.co.in/'); // ye kisi dusre page/path me lekar jata hai
    }
    else(
        window.alert('wrong username and password!') // ye ek pup up show karta hai ki aapka password wrong h ai
    )



    console.log(username);
    console.log(password);
}
login()