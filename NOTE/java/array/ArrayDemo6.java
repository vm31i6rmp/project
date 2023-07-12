package array;

// 內存的三種階層
public class ArrayDemo6 { // 方法需內存（class）
  public static void main(String[] args) { // 棧內存（main）
    int a = 10;
    System.out.println(a);

    // 堆內存（new）
    int[] arr1 = new int[] {10, 20, 30};
    System.out.println(arr1);

    arr1[0] = 40;
    arr1[1] = 50;
    arr1[2] = 60;

    int[] arr2 = arr1; // arr1 的地址（[I@251a69d7）格納給 arr2（[I@251a69d7）
    System.out.println(arr1);
    System.out.println(arr2);

    arr2[0] = 70;
    System.out.println(arr1[0]); // 70（地址 [I@251a69d7 的第一個項目）
  }
}
