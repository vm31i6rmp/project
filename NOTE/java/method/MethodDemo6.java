package method;

public class MethodDemo6 {
  public static void main(String[] args) {
    // 配列の元素のindexを返す
    int[] arrs = {11, 22, 33, 44, 55};
    System.out.println(getIndex(arrs, 22));
    System.out.println(getIndex(arrs, 99));
  }
  public static int getIndex(int[] arrs, int arr) {
    for (int i = 0; i < arrs.length; i++) {
      if(arrs[i] == arr) {
        return i;
      }
    }
    return -1; // 元素が存在しない
  }
}
