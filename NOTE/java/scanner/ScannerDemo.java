package scanner;
import java.util.Scanner;

public class ScannerDemo {
  public static void main(String[] args) {
    // 鍵盤掃描器
    Scanner sc = new Scanner(System.in);
    System.out.println("年齢を入力してください。");
    int age = sc.nextInt();
    sc.close();
    System.out.println("あなたの年齢は" + age + "歳です。");
  }
}