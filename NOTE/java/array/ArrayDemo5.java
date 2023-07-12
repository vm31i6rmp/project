package array;

public class ArrayDemo5 {
  public static void main(String[] args) {
    /* 排序 */
    // 冒泡排序＝最大值放到最後 需執行(個數-1)輪
    int[] arr1 = {5, 2, 3, 1, 4};
    for (int i = 0; i < arr1.length - 1 ; i++) {
      // i == 0 比較次數 3  j = 0 1 2
      // i == 1 比較次數 2  j = 0 1
      // i == 2 比較次數 1  j = 0
      for (int j = 0; j < arr1.length - i - 1; j++) {
        if(arr1[j] > arr1[j+1]) {
          int temp = arr1[j+1];
          arr1[j+1] = arr1[j];
          arr1[j] = temp;
        }
      }
    }
    for (int i = 0; i < arr1.length; i++) {
      System.out.print(arr1[i] + " ");
    }
  }
}
