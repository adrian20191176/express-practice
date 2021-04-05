function mapAsync(arr,fn,onFinish){
    let prevError
    let nRemaining = arr.length
    const result =[]
    arr.forEach((element,i) => {
        fn(function(err,data){
            if(prevError) return;

            if(err){
                prevError = err;
                return onFinish(err);
            }

            result[i] = data
            console.log(element)
            nRemaining-- 
            if(!nRemaining) onFinish(null,result)
        },element*10000)
    });
}

const seconds = [1,2]

mapAsync(seconds,setTimeout,(err,result) => {console.log("Done")})