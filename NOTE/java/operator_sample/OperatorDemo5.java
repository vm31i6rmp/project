package operator_sample;

public class OperatorDemo5 {
  public static void main(String[] args) {
    // 三項運算子
    double score = 98;
    String rs = score >= 60 ? "合格" : "不合格";
    System.out.println(rs);

    // 求最大值
    int a = 10;
    int b = 2000;
    int max = a > b ? a : b;
    System.out.println(max);

    int i = 10;
    int j = 50;
    int k = 30;
    int max2 = i > j ? (i > k ? i : k) : (j > k ? j : k);
    // int max2 = i > j ? i > k ? i : k : j > k ? j : k;
    System.out.println(max2);

    /*   優先度
     *   ()
     *   ! - ++ --
     *   * / %
     *   + -
     *   << >> >>>
     *   < <= > >= instanceof
     *   == !=
     *   &
     *   ^
     *   |
     *   &&
     *   ||
     *   ?:
     *   = += -= *= /= %= &=
     */
  }
}
