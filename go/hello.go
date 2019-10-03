package main
import (
	"github.com/jung-kurt/gofpdf"
)
func main() {

	pdf := gofpdf.New(gofpdf.OrientationPortrait, "mm", "A4", "")
	pdf.AddPage()
	pdf.SetFont("Arial", "B", 16)
	pdf.Cell(480, 480, "Hello World!")
	pdf.OutputFileAndClose("hello.pdf")

}