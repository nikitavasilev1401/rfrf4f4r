using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Word = Microsoft.Office.Interop.Word;


namespace exzamen
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        double cost = 0;
        string size = "";
        string material = "";
        double price = 0;

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text != "" && textBox2.Text != "")
            {
                double width = Convert.ToDouble(textBox1.Text);
                double height = Convert.ToDouble(textBox2.Text);
                if (checkBox1.Checked == false && checkBox2.Checked == false)
                {
                    MessageBox.Show("Выберите материал!");
                    label6.Text = "";
                    label7.Text = "";
                    label5.Text = "";
                }
                else if (checkBox1.Checked && checkBox2.Checked)
                {
                    MessageBox.Show("Выберите один из материалов!");
                    label6.Text = "";
                    label7.Text = "";
                    label5.Text = "";
                }
                else
                {
                    label6.Text = ($"{width}x{height} см");
                    size = $"{width}x{height} см";
                    if (checkBox1.Checked == true)
                    {
                        material = "Алюминий";
                        price = 15.5;
                    }
                    else
                    {
                        material = "Пластик";
                        price = 9.9;
                    }
                    label7.Text = material;
                    cost = Math.Round((width * height / 100 * price), 2);
                    label5.Text = ($"Стоимость:  {cost} руб");
                }
            }
            else
            {
                MessageBox.Show("Введите ширину и длину!");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Word.Document doc = null;
            try
            {
                Word.Application app = new Word.Application();
                string source = @"C:\Users\Администратор\Desktop\xzamen\exzamen\exzamen\bin\Debug\Квитанция.docx";
                doc = app.Documents.Open(source);
                doc.Activate();
                Word.Bookmarks wBookmarks = doc.Bookmarks;
                Word.Range wRange;
                string date = DateTime.Now.ToString();
                Random rnd = new Random();
                int i = 0;
                string[] data = new string[6] { cost.ToString(), date, cost.ToString(), material, rnd.Next(1, 999).ToString(), size };
                foreach (Word.Bookmark mark in wBookmarks)
                {
                    wRange = mark.Range;
                    wRange.Text = data[i];
                    i++;
                }
                doc.SaveAs2(@"C:\Users\Администратор\Desktop\xzamen\exzamen\exzamen\bin\Debug\Квитанция" + rnd.Next(10000, 999999) + ".docx");
                doc.Close();
                doc = null;
            }
            catch (Exception)
            {
                doc.Close();
                doc = null;
                MessageBox.Show("Во время выполнения произошла ошибка!");
            }
        }
    }
}
