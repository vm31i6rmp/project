package operator_sample;

public class OperatorDemo2 {
  public static void main(String[] args) {
    int a = 10;
    int b = 3;
    System.out.println(a + b);
    System.out.println(a - b);
    System.out.println(a * b);
    System.out.println(a / b); // 自動轉換成最高類型int
    System.out.println(a * 1.0 / b);
    System.out.println(a % b); // 餘數

    // 求三位數的個位數、十位數、百位數
    int data = 589;

    int ge = data % 10;
    int shi = data / 10 % 10;
    int bai = data / 100;

    System.out.println(data + "的個位數＝" + ge); // + 不能運算時作為連接運算子
    System.out.println(data + "的十位數＝" + shi);
    System.out.println(data + "的百位數＝" +bai);

    int n = 5;
    System.out.println(n + 'n'); // int(5) + char(110) = 115

    int aa = 10;
    int bb = 10;
    int res1 = aa++; // 先把 aa 格納給 res1 再 ++
    int res2 = ++bb; // 先 ++ 再把 bb 格納給 res2
    System.out.println(aa);
    System.out.println(res1);
    System.out.println(bb);
    System.out.println(res2);

    int k = 3;
    int p = 5;
    int rs = k++ + ++k - --p + p--;
    // k  3   4     5
    // p  5               4     3
    // rs     3  +  5  -  4  +  4
    System.out.println(k);  // 5
    System.out.println(p);  // 3
    System.out.println(rs); // 8
  }
}
