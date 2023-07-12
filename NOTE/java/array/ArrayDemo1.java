package array;

public class ArrayDemo1 {
  public static void main(String[] args) {
    //（1）静的な配列定義：最初値を格納（個数は指定不可！）
    int[] nums = new int[] {10, 20, 30, 40, 50}; // new 型[] は省略可能
    String[] names = new String[] {"田中", "鈴木", "佐藤"};
    System.out.println(nums); // [I@251a69d7（配列名にはこの配列のIDが格納されている）
    System.out.println(names); // [Ljava.lang.String;@7344699f
    System.out.println(nums[0]);
    System.out.println(names[0]);
    System.out.println(nums.length);
    System.out.println(names.length);

    int nums2[] = {10, 20, 30}; // []は型の後でも、配列名の後でも可能
    System.out.println(nums2.length);

    //（2）動的な配列作成：個数だけ指定（値は後で格納！）
    int[] arr = new int[3]; // length = 3
    arr[0] = 10;
    System.out.println(arr[0]);
    System.out.println(arr[1]);
    System.out.println(arr[2]);

    // 空の配列のdefault値
    // byte、short、char、int、long -> 0
    // float、double -> 0.0
    // boolean -> false
    // class、接口、array、String -> null
  }
}