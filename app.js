const seconds = [1,2]

seconds.forEach((sec) =>
{
    setTimeout(()=>{ console.log(sec)},sec*1000)
})

console.log("Done")