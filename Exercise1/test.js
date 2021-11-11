var arr = [123, '123', 'hello', 'world', 123]
console.log(arr);

function unique(arr) {
    // 编写代码
     let newArr = [];
     for (i = 1; i < arr.length; i++){
         if (arr[i] !== arr[i-1]){
             newArr.push(arr[i])
         }
     }
     return newArr;
 }