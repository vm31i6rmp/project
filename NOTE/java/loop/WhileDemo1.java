package loop;

public class WhileDemo1 {
  public static void main(String[] args) {
    // 知道循環次數時用for、不知道循環次數時用while
    int i = 0;
    while(i < 3) {
      System.out.println("Hello World!");
      i++; // 忘れると無限循環になる
    }

    // 珠穆朗瑪峰8848.86公尺、紙張厚度0.1毫米要折疊幾次才能超過
    int count = 0;
    double peakHeight = 8848860;
    double paperWidth = 0.1;
    while (paperWidth < peakHeight) {
      paperWidth *= 2;
      count++;
    }
    System.out.println("折疊次數：" + count + "次");
    System.out.println("紙張最後的厚度：" + paperWidth + "公分");
  }
}
