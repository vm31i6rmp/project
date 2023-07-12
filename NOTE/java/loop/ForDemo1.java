package loop;

public class ForDemo1 {
  public static void main(String[] args) {
    int sum = 0;
    for(int i = 1; i <= 5; i++) {
      sum += i;
    }
    System.out.println(sum);

    int sum2 = 0;
    for(int i = 1; i <= 10; i++) {
      if(i % 2 == 1) {
        sum2 += i;
      }
    }
    System.out.println(sum2);
  }
}
