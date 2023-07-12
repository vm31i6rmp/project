package method;

public class MethodDemo7 {
  // 2つの配列が一緒であるかどうかを判断
  public static void main(String[] args) {
    int[] arr1 = {10, 20, 30};
    int[] arr2 = {10, 200, 30};
    System.out.println(compare(arr1, arr2));
  }
  public static boolean compare(int[] arr1, int[] arr2) {
    if(arr1.length == arr2.length) {
      for (int i = 0; i < arr1.length; i++) {
        if(arr1[i] != arr2[i]) {
          return false;
        }
      }
    return true;
    } else {
      return false;
    }
  }
}
